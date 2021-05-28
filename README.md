# Aktuelle globale Beiträge


## Mit "Letzte globale Beiträge" kannst Du eine Liste der letzten Beiträge aus Deinem Multisite-Netzwerk auf Deiner Hauptwebseite anzeigen.

### Gebaut für Dein Netzwerk

Dieses Plugin nutzt die Leistung von [Multisite Beitragsindex](https://n3rds.work/piestingtal_source/multisite-beitragsindex-plugin/ "Multisite Beitragsindex"), um aktuelle Beiträge überall auf Deiner Hauptwebswite mithilfe von Shortcodes dynamisch zu veröffentlichen - auf Seiten, Posts und Widget-Bereiche, z.B. eine Seitenleiste oder eine Fußzeile. Aktuelle globale Beiträge wurde von WordPress-Netzwerkexperten entwickelt und unterstützt und bietet den sicheren, zuverlässigen Service, den Du für den Betrieb einer erfolgreichen Multisite- oder BuddyPress-Community benötigst. 

![image](http://premium.wpmudev.org/wp-content/uploads/2009/06/latestposts.jpg)

 Hilf Benutzern, neue Inhalte aus Deinem Netzwerk zu entdecken, und stärke Dein Gemeinschaftsgefühl mit den neuesten globalen Beiträgen.

## Verwendung

### Anzeigen Deiner Netzwerkbeiträge

Du kannst Deine letzten Beiträge überall auf Deiner Webseite anzeigen, indem Du einfach einen Shortcode hinzufügst. Der Basis-Shortcode lautet:

    [globalrecentposts]

Daraufhin wird eine einfache Liste der verknüpften Titel der 5 neuesten Beiträge in Deinem Netzwerk angezeigt. 

![Recent Network Posts Basic Display](https://premium.wpmudev.org/wp-content/uploads/2009/06/recent-network-posts-3000-basic-list.png)

 But you can use the following attributes to really customize what content to display, and how to display it:

*   _number="5"_ - How many posts you want to display
*   _title_characters="250"_ - Maximum number of characters in each title.
*   _content_characters="200"_ - Maximum number of characters in the content of each entry
*   _title_content_divider="-"_ - What to use to separate the title from the content. If this parameter is not included, the content will display beneath the title.
*   _title_link="no"_ - By default, the title links to the post. You can use this to remove the link.
*   _show_avatars="yes"_ - Displays the author avatar if avatars are used on your site.
*   _avatar_size="32"_ - Sets the square size of the avatars.
*   _posttype="post-type"_ - Use to specify the post type to display. Default is "post". Note that you can only specify one post-type.

So, for example, if you want to show the 3 most recent posts with a little excerpt and author avatar, you could use it like this:

    [globalrecentposts number="3" content_characters="200" show_avatars="yes" avatar_size="32"]

The above shortcode would produce something like this on your site: 

![Recent Network Posts Avatar List](https://premium.wpmudev.org/wp-content/uploads/2009/06/recent-network-posts-3000-avatar-list.png)

 Don't like the default styling? You can also use these parameters to add text or HTML elements to really customize the content, as well as layout & styling:

*   _title_before="text or HTML element"_ - Executes before the title of each entry.
*   _title_after="text or HTML element"_ - Executes after the title of each entry.
*   _global_before="text or HTML element"_ - Executes above the list of entries.
*   _global_after="text or HTML element"_ - Executes beneath the list of entries.
*   _before="text or HTML element"_ - Executes before each entry.
*   _after="text or HTML element"_ - Executes after each entry.

Here's an example shortcode with some of these extra parameters. You'll notice we've included headline tags for the titles, and a custom class for each entry so we can style the output with a bit of custom CSS.

[globalrecentposts number="2" content_characters="200" global_before="Here are our most recent posts. Enjoy!" before="" after="" show_avatars="yes" avatar_size="48" title_before="" title_after=""]

The above shortcode could display something like this (note that the actual CSS to be used would depend a lot on your theme, so we haven't included that here). 

![Recent Network Posts Styled List](https://premium.wpmudev.org/wp-content/uploads/2009/06/recent-network-posts-3000-styled-list.png)
