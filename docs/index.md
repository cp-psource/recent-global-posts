---
layout: psource-theme
title: "Netzwerkbeiträge"
---

<h2 align="center" style="color:#38c2bb;">📚 Netzwerkbeiträge</h2>

<div class="menu">
  <a href="https://github.com/cp-psource/recent-global-posts/discussions" style="color:#38c2bb;">💬 Forum</a>
  <a href="https://github.com/cp-psource/recent-global-posts/releases" style="color:#38c2bb;">📝 Download</a>
</div>



# Netzwerk-Beiträge (Network Recent Posts)

# Netzwerk-Beiträge (Network Recent Posts)

Ein WordPress Multisite-Plugin zur Anzeige aktueller Beiträge aus allen Blogs im Netzwerk als Liste oder Grid.

---

## Features

- Netzwerkkonforme Abfrage von Beiträgen über das [Post Indexer Plugin](https://deine-url-zum-plugin)  
- Anzeige von Beitragsbild, Autor, Blogname und Auszug  
- Layout-Auswahl: Liste oder Grid  
- Anpassbarer „Weiterlesen“-Text  
- Zentrale Steuerung aller Einstellungen im Netzwerk-Admin-Dashboard  
- Keine Shortcode-Attribute nötig (keine Dopplung der Einstellungen)  
- Automatische Umschaltung in den Blog-Kontext für korrekte Daten (Thumbnails, Autoren etc.)

---

## Voraussetzungen

- WordPress Multisite (ab Version 6.x empfohlen)  
- PHP 7.4 oder höher  
- Aktiviertes und konfiguriertes **Post Indexer Plugin** (Basis für Netzwerkanfragen)

---

## Installation

1. Plugin im Netzwerk hochladen und im Netzwerk-Admin aktivieren  
2. Post Indexer Plugin sicherstellen und konfigurieren  
3. Im Netzwerk-Admin unter **Netzwerk → Einstellungen → Netzwerk-Beiträge** die gewünschten Optionen einstellen  
4. Shortcode `[network_recent_posts]` in Seiten oder Beiträgen verwenden

---

## Einstellungen (im Netzwerk-Admin)

- **Anzahl Beiträge:** Anzahl der anzuzeigenden Beiträge  
- **Post-Typ:** Welcher Beitragstyp soll angezeigt werden (Standard: Beitrag)  
- **Layout:** Liste oder Grid  
- **Beitragsbild anzeigen:** Ja/Nein  
- **Bildgröße:** WordPress Bildgrößen (thumbnail, medium, large, full)  
- **Autor anzeigen:** Ja/Nein  
- **Blogname anzeigen:** Ja/Nein  
- **Weiterlesen-Text:** Freitext für Link am Ende jedes Beitrags

---

## Shortcode

```plaintext
[network_recent_posts]
```
Aktuell ohne zusätzliche Attribute, da alle Einstellungen im Dashboard konfiguriert werden.

Technische Details
Nutzt Funktionen des Post Indexer Plugins (network_query_posts(), network_the_post()) zur performant-netzwerkweiten Abfrage

Innerhalb der Schleife wird per switch_to_blog() in den jeweiligen Blog-Kontext gewechselt, um z.B. Beitragsbild (get_post_thumbnail_id()) korrekt zu holen

Daten werden gesammelt, sortiert (nach Titel), dann als HTML ausgegeben

Saubere Trennung von Daten und Ausgabe für einfaches Anpassen und erweitern

Fehlerbehandlung, falls Post Indexer nicht aktiv ist