# Aktuelle globale Beiträge


## Mit "Letzte globale Beiträge" kannst Du eine Liste der letzten Beiträge aus Deinem Multisite-Netzwerk auf Deiner Hauptwebseite anzeigen.

### Gebaut für Dein Netzwerk

Dieses Plugin nutzt die Leistung von [Multisite Beitragsindex](https://n3rds.work/piestingtal_source/multisite-beitragsindex-plugin/ "Multisite Beitragsindex"), um aktuelle Beiträge überall auf Deiner Hauptwebswite mithilfe von Shortcodes dynamisch zu veröffentlichen - auf Seiten, Posts und Widget-Bereiche, z.B. eine Seitenleiste oder eine Fußzeile. Aktuelle globale Beiträge wurde von WordPress-Netzwerkexperten entwickelt und unterstützt und bietet den sicheren, zuverlässigen Service, den Du für den Betrieb einer erfolgreichen Multisite- oder BuddyPress-Community benötigst. 


 Hilf Benutzern, neue Inhalte aus Deinem Netzwerk zu entdecken, und stärke Dein Gemeinschaftsgefühl mit den neuesten globalen Beiträgen.

## Verwendung

### Anzeigen Deiner Netzwerkbeiträge

Du kannst Deine letzten Beiträge überall auf Deiner Webseite anzeigen, indem Du einfach einen Shortcode hinzufügst. Der Basis-Shortcode lautet:

    [globalrecentposts]

Daraufhin wird eine einfache Liste der verknüpften Titel der 5 neuesten Beiträge in Deinem Netzwerk angezeigt. 


 Du kannst jedoch die folgenden Attribute verwenden, um wirklich anzupassen, welche Inhalte angezeigt werden sollen und wie sie angezeigt werden:

*   _number="5"_ - Wie viele Beiträge Du anzeigen möchtest
*   _title_characters="250"_ - Maximale Anzahl von Zeichen in jedem Titel.
*   _content_characters="200"_ - Maximale Anzahl von Zeichen im Inhalt jedes Eintrags
*   _title_content_divider="-"_ - Was ist zu verwenden, um den Titel vom Inhalt zu trennen. Wenn dieser Parameter nicht enthalten ist, wird der Inhalt unter dem Titel angezeigt.
*   _title_link="no"_ - Standardmäßig verlinkt der Titel auf den Beitrag. Damit kannst du den Link entfernen.
*   _show_avatars="yes"_ - Zeigt den Avatar des Autors an, wenn Avatare auf Deiner Webseite verwendet werden.
*   _avatar_size="32"_ - Legt die quadratische Größe der Avatare fest.
*   _posttype="post-type"_ - Verwende diese Option, um den anzuzeigenden Beitragstyp anzugeben. Standard ist "post". Beachte, dass Du nur einen Beitragstyp angeben kannst.

Wenn Du also zum Beispiel die 3 neuesten Beiträge mit einem kleinen Auszug und einem Autoren-Avatar anzeigen möchtest, kannst Du dies so verwenden:

    [globalrecentposts number="3" content_characters="200" show_avatars="yes" avatar_size="32"]

Der obige Shortcode würde auf Deinerer Webseite so etwas erzeugen: 

![Recent Network Posts Avatar List]()

 Gefällt Dir das Standard-Styling nicht? Du kannst diese Parameter auch verwenden, um Text- oder HTML-Elemente hinzuzufügen, um den Inhalt sowie das Layout und das Styling wirklich anzupassen:

*   _title_before="text or HTML element"_ - Wird vor dem Titel jedes Eintrags ausgeführt.
*   _title_after="text or HTML element"_ - Wird nach dem Titel jedes Eintrags ausgeführt.
*   _global_before="text or HTML element"_ - Wird oberhalb der Liste der Einträge ausgeführt.
*   _global_after="text or HTML element"_ - Wird unter der Liste der Einträge ausgeführt.
*   _before="text or HTML element"_ - Wird vor jedem Eintrag ausgeführt.
*   _after="text or HTML element"_ - Wird nach jedem Eintrag ausgeführt.

Hier ist ein Beispiel-Shortcode mit einigen dieser zusätzlichen Parameter. Du wirst feststellen, dass wir Schlagzeilen-Tags für die Titel und eine benutzerdefinierte Klasse für jeden Eintrag hinzugefügt haben, damit wir die Ausgabe mit etwas benutzerdefiniertem CSS gestalten können.

[globalrecentposts number="2" content_characters="200" global_before="Hier sind unsere neuesten Beiträge. Genießen!" before="" after="" show_avatars="yes" avatar_size="48" title_before="" title_after=""]

Der obige Shortcode könnte so etwas anzeigen (beachte, dass das tatsächlich zu verwendende CSS stark von Deinem Theme abhängt, daher haben wir das hier nicht aufgenommen). 

![Recent Network Posts Styled List]()
