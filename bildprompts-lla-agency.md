# Bild-Prompts für die LLA Agency Website

**Status: Alle 13 Bilder wurden bereits generiert und in die Website eingebaut** (liegen im Ordner `img/`). Diese Liste bleibt als Referenz erhalten – z. B. falls du später weitere Konzeptprojekte im selben Stil ergänzen möchtest, oder um den Stil-Anker für neue Motive wiederzuverwenden.

Ich kann in dieser Umgebung keine Bilder selbst generieren. Diese Liste ist der Ersatz dafür: 13 fertige, exakt zugeordnete Prompts, die du in ein Bildgenerierungs-Tool einfügen kannst (z. B. Midjourney, DALL·E 3 / ChatGPT, Adobe Firefly, oder in Claude selbst, sobald Bildgenerierung dort aktiv ist).

**So gehst du vor:**
1. Prompt kopieren, im gewünschten Format generieren (Seitenverhältnis unten angegeben).
2. Datei exakt so benennen wie in Spalte "Datei" angegeben (oder eigenen Namen wählen und in `index.html` an der markierten Stelle anpassen).
3. Datei in denselben Ordner wie `index.html` und `logo.png` legen.
4. An der mit `<!-- BILD: ... -->` markierten Stelle im HTML den `<div class="p-visual-inner">` bzw. den jeweiligen Platzhalter durch ein `<img>`-Tag mit `object-fit:cover` ersetzen (Beispielcode steht direkt im Kommentar über jedem Platzhalter).

Alle Platzhalter sind bereits im Code mit genau diesen Dateinamen kommentiert – du musst nur suchen und ersetzen.

---

## Einheitlicher Stil-Anker

Damit alle Bilder wie aus einer gemeinsamen Kampagne wirken, hänge an **jeden** der folgenden Prompts diesen Stil-Baustein an:

> *Ultra-premium product photography for a luxury creative agency, shot on a Phase One medium-format camera, studio lighting with soft key light and subtle rim light, shallow depth of field, dark charcoal-black background (#0a0a0c), teal/petrol accent lighting (#2fb4c4) combined with brushed silver reflections (#c6ccd2), minimalist composition, generous negative space, floating product with soft realistic shadow, photorealistic, 8k detail, no visible logos or brand names, fictional generic product design, advertising campaign quality, cinematic color grading.*

---

## Portfolio-Bilder (Abschnitt „Projekte")

| # | Datei | Format | Motiv & Prompt |
|---|-------|--------|-----------------|
| 1 | `portfolio-01-webseite.jpg` | 21:8 (quer) | Laptop and smartphone mockup floating at a slight angle, displaying a fictional minimalist dark-themed website homepage with teal accents, on a dark reflective surface, premium tech-agency showcase |
| 2 | `portfolio-02-sneaker.jpg` | 4:5 (hochkant) | A single fictional premium sneaker floating mid-air, dramatic side lighting, teal and silver rim light, dark gradient background, dynamic dust particles, sportswear campaign |
| 3 | `portfolio-03-protein-drink.jpg` | 4:5 (hochkant) | Fictional matte-black protein shake bottle with unlabeled minimalist design, dynamic liquid splash frozen mid-motion, water droplets on the bottle, dark studio background with teal highlight |
| 4 | `portfolio-04-kopfhoerer.jpg` | 4:5 (hochkant) | Fictional wireless over-ear headphones floating above a dark reflective surface, clean e-commerce-style lighting, subtle silver reflections, minimal shadow beneath |
| 5 | `portfolio-05-parfum.jpg` | 4:5 (hochkant) | Elegant fictional perfume bottle with faceted glass, dramatic single-source side light, deep black background, soft reflection on glossy surface below, luxury fragrance campaign |
| 6 | `portfolio-06-smartwatch.jpg` | 4:5 (hochkant) | Macro close-up of a fictional smartwatch face and strap, extreme detail on texture and material, teal-lit display screen, shallow depth of field, dark premium background |
| 7 | `portfolio-07-skincare.jpg` | 4:5 (hochkant) | Minimalist fictional skincare dropper bottle standing on a dark stone surface, soft diffused studio light, subtle water droplets, calm and clean beauty-campaign mood |

---

## Weitere Bildplätze (gesamte Website)

| # | Datei | Format | Einsatzort | Motiv & Prompt |
|---|-------|--------|------------|-----------------|
| 8 | `showreel-poster.jpg` | 16:8 (quer) | Hero-Bereich, Showreel-Vorschau | Behind-the-scenes moment of a product photo shoot: camera on a tripod pointed at a floating product on a dark studio set, dramatic teal rim lighting, cinematic atmosphere, shallow depth of field |
| 9 | `hero-background.jpg` (optional) | 16:9, sehr breit | Ganz oben im Hero-Bereich, als zusätzliche Ebene hinter dem bestehenden Verlauf | Abstract dark studio backdrop with soft teal and silver light trails, subtle smoke/atmosphere, minimal and elegant, no objects, pure atmosphere for a hero background |
| 10 | `webseiten-mockup.jpg` | 4:3 | Abschnitt „Premium Webseiten", Browser-Mockup | Close-up of a laptop screen displaying a fictional elegant dark website homepage with a bold headline and teal accent button, shallow depth of field, soft reflection on screen |
| 11 | `vorher-beispiel.jpg` | 4:3 | Abschnitt „Der Unterschied", Karte „Vorher" | The same fictional product (e.g. a simple cosmetic bottle) photographed with flat overhead phone-camera lighting, slightly cluttered background, mediocre amateur product photo look, muted colors |
| 12 | `nachher-beispiel.jpg` | 4:3 | Abschnitt „Der Unterschied", Karte „Nachher" | The identical fictional product from image 11, now shot as premium studio photography: dramatic lighting, clean dark background, teal accent light, professional reflection, high-end campaign quality |
| 13 | `about-studio.jpg` | 4:5 (hochkant) | Abschnitt „Über LLA Agency" | Moody creative studio setup: softbox lights, camera equipment and a partially visible product on a set, dark and elegant atmosphere, teal accent lighting, no visible people or faces |

---

## Hinweis zu Bild 11 / 12 (Vorher/Nachher)

Für den stärksten Effekt sollten beide Bilder **dasselbe fiktive Produkt** zeigen — einmal absichtlich mittelmäßig fotografiert (Vorher), einmal als Premium-Kampagnenbild (Nachher). Am einfachsten: zuerst Bild 12 (Nachher) generieren, dann im selben Tool mit „gleiches Produkt, aber flach beleuchtet und amateurhaft fotografiert" für Bild 11 nachziehen.

---

## Bereits im Code umgesetzt

Diese Punkte musst du nicht mehr selbst bauen — sind schon in `index.html` enthalten:

- Jede Portfolio-Karte trägt bereits ein dezentes **„Konzeptprojekt"**-Badge (oben links auf der Karte und in der Detailansicht), das klarstellt, dass es sich um Demo-Arbeiten handelt.
- Jede Portfolio-Kachel hat schon ein passendes, dezentes Icon (Sneaker, Flasche, Kopfhörer, Parfum, Smartwatch, Skincare, Browser-Fenster) als Platzhalter, solange die echten Bilder noch fehlen.
- Alle Bildbereiche nutzen `object-fit:cover` in den Beispiel-Snippets im Code, damit später kein Bild verzerrt oder falsch zugeschnitten wird — du musst nur die `<img>`-Tags einsetzen, der Zuschnitt passt sich automatisch responsiv an.
