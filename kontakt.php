<?php
/**
 * Nimmt das Kontaktformular entgegen und schickt die Anfrage per E-Mail.
 *
 * Antwortet auf zwei Arten, damit das Formular auch ohne JavaScript
 * funktioniert:
 *   - Wenn JavaScript per fetch anfragt (Accept: application/json),
 *     kommt JSON zurueck und die Seite bleibt stehen.
 *   - Bei einem normalen Formular-POST kommt eine schlichte HTML-Seite.
 *
 * Die Absenderadresse muss zur Domain gehoeren, sonst stuft der
 * empfangende Server die Mail wegen SPF als Spam ein. Die Adresse des
 * Absenders steht deshalb in Reply-To, nicht in From.
 */

declare(strict_types=1);

const EMPFAENGER   = 'info@lilla-webmedia.de';
const ABSENDER     = 'noreply@lilla-webmedia.de';
const MAX_LAENGE   = 5000;

/** Zeilenumbrueche aus Kopfzeilen entfernen - sonst liessen sich ueber
 *  ein Eingabefeld zusaetzliche Mail-Header einschleusen. */
function kopfzeilenSicher(string $wert): string {
    return trim(str_replace(["\r", "\n", "%0a", "%0d"], '', $wert));
}

function feld(string $name, int $max = 300): string {
    $wert = $_POST[$name] ?? '';
    if (!is_string($wert)) return '';
    $wert = trim($wert);
    /* mbstring ist nicht ueberall aktiv - dann zeichenweise kuerzen */
    return function_exists('mb_substr') ? mb_substr($wert, 0, $max) : substr($wert, 0, $max);
}

function antworten(bool $ok, string $text, int $status = 200): void {
    http_response_code($status);
    /* strpos statt str_contains: laeuft auch auf PHP 7 */
    $accept = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '';
    $willJson = strpos($accept, 'application/json') !== false;

    if ($willJson) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => $ok, 'text' => $text], JSON_UNESCAPED_UNICODE);
        return;
    }

    header('Content-Type: text/html; charset=utf-8');
    $sicher = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    echo <<<HTML
    <!doctype html><html lang="de"><head><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anfrage – Lilla Web &amp; Media</title>
    <style>
      body{margin:0;min-height:100vh;display:flex;align-items:center;justify-content:center;
           background:#07080a;color:#f2f3f4;font:16px/1.6 system-ui,sans-serif;padding:24px}
      .box{max-width:460px;text-align:center}
      a{color:#2fb4c4}
    </style></head><body><div class="box">
      <p>{$sicher}</p><p><a href="/">Zurück zur Startseite</a></p>
    </div></body></html>
    HTML;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    antworten(false, 'Diese Seite nimmt nur Formulare entgegen.', 405);
    exit;
}

/* Honigtopf: ein fuer Menschen unsichtbares Feld. Bots fuellen es aus,
   echte Besucher nicht. Wir melden trotzdem Erfolg, damit der Bot nicht
   merkt, dass er erkannt wurde. */
if (feld('website') !== '') {
    antworten(true, 'Danke für deine Anfrage.');
    exit;
}

$name       = kopfzeilenSicher(feld('name', 120));
$unternehmen= kopfzeilenSicher(feld('company', 120));
$email      = kopfzeilenSicher(feld('email', 160));
$leistung   = kopfzeilenSicher(feld('service', 120));
$nachricht  = feld('message', MAX_LAENGE);

$fehler = [];
if ($name === '')                                        $fehler[] = 'Name';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $fehler[] = 'gültige E-Mail-Adresse';
if ($leistung === '')                                    $fehler[] = 'gewünschte Leistung';
if ($nachricht === '')                                   $fehler[] = 'Nachricht';

if ($fehler) {
    antworten(false, 'Bitte ergänze noch: ' . implode(', ', $fehler) . '.', 422);
    exit;
}

$betreff = 'Projektanfrage über lilla-webmedia.de';
$text = implode("\n", [
    'Name: '            . $name,
    'Unternehmen: '     . ($unternehmen !== '' ? $unternehmen : '-'),
    'E-Mail: '          . $email,
    'Gewünschte Leistung: ' . $leistung,
    '',
    'Nachricht:',
    $nachricht,
    '',
    '---',
    'Gesendet am ' . date('d.m.Y H:i') . ' Uhr über das Kontaktformular.',
]);

$header = [
    'From: Lilla Web & Media <' . ABSENDER . '>',
    'Reply-To: ' . $name . ' <' . $email . '>',
    'Content-Type: text/plain; charset=UTF-8',
    'MIME-Version: 1.0',
    'X-Mailer: PHP/' . phpversion(),
];

$gesendet = @mail(
    EMPFAENGER,
    '=?UTF-8?B?' . base64_encode($betreff) . '?=',
    $text,
    implode("\r\n", $header),
    '-f' . ABSENDER
);

if ($gesendet) {
    antworten(true, 'Danke für deine Anfrage. Ich melde mich schnellstmöglich bei dir.');
} else {
    antworten(false, 'Das hat gerade nicht geklappt. Schreib mir bitte direkt an ' . EMPFAENGER . '.', 500);
}
