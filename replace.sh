#!/bin/bash

# Setzen der Umgebungsvariable für die Zeichenkodierung
export LC_CTYPE=C

read -p "Plugin Name (Replace WordPress Plugin Boilerplate): " plugin_name
read -p "Plugin Description (Replace This is a short description of what the plugin does.): " plugin_desc
read -p "Plugin Namespace Name (Replace WPPluginName): " namespace_name
read -p "Plugin Class Name (Replace WP_Plugin_Name): " plugin_class_name
read -p "Plugin Defined Name (Replace WP_PLUGIN): " plugin_defined_name
read -p "Plugin Slug Name (Replace wp-plugin-name): " plugin_slug_name
read -p "Plugin Slug Prefix Name (Replace wp_plugin_name_): " plugin_prefix_name
read -p "Plugin Author Name (Replace Your Name or Your Company): " plugin_author_name
read -p "Plugin Domain (Replace http://example.com): " plugin_domain

# Pfad zum Unterordner
plugin_dir="./wp-plugin-name"

# Funktion zur Durchführung der Suche und Ersetzung
replace_string() {
  local suche=$1
  local ersetze=$2
  local pfad="$plugin_dir" # Pfad zum Unterordner
  grep -rl --exclude="*.sh" --exclude="*.json" --exclude="*.md" --exclude="*.txt" "$suche" "$pfad" | xargs sed -i '' "s|$suche|$ersetze|g"
}

if [[ -z $plugin_name ]]; then
  plugin_name="WordPress Plugin Boilerplate"
fi

replace_string "WordPress Plugin Boilerplate" "${plugin_name}"

if [[ -z $plugin_desc ]]; then
  plugin_desc="This is a short description of what the plugin does."
fi

replace_string "This is a short description of what the plugin does." "${plugin_desc}"

if [[ -z $namespace_name ]]; then
  namespace_name="WPPluginName"
fi

replace_string "WPPluginName" "${namespace_name}"

if [[ -z $plugin_class_name ]]; then
  plugin_class_name="WP_Plugin_Name"
fi

replace_string "WP_Plugin_Name" "${plugin_class_name}"

if [[ -z $plugin_defined_name ]]; then
  plugin_defined_name="WP_PLUGIN"
fi

replace_string "WP_PLUGIN" "${plugin_defined_name}"

if [[ -z $plugin_slug_name ]]; then
  plugin_slug_name="wp-plugin-name"
fi

replace_string "wp-plugin-name" "${plugin_slug_name}"

if [[ -z $plugin_prefix_name ]]; then
  plugin_prefix_name="wp_plugin_name_"
fi

replace_string "wp_plugin_name_" "${plugin_prefix_name}"

if [[ -z $plugin_author_name ]]; then
  plugin_author_name="Your Name or Your Company"
fi

replace_string "Your Name or Your Company" "${plugin_author_name}"

if [[ -z $plugin_domain ]]; then
  plugin_domain="http://example.com"
fi

replace_string "http://example.com" "${plugin_domain}"

# Umbenennen der Haupt-Plugin-Datei
mv "${plugin_dir}/wp-plugin-name.php" "${plugin_dir}/${plugin_slug_name}.php"

# Umbenennen des Verzeichnisses
mv "$plugin_dir" "./${plugin_slug_name}"

echo "Ersetzungen und Umbenennungen sind abgeschlossen. Verzeichnis ist nun ./${plugin_slug_name}."
exit 0
