# erik
My Wordpress Blog Theme

# Sass (version: 3.4.11)

### Watch

- **style.css (expanded)**
  + sass --watch assets/sass/style.scss:style.css --style expanded --cache-location ./assets/sass/.sass-cache

- **style.css (minified)**
  + sass --watch assets/sass/style.scss:style.css --style compressed --cache-location ./assets/sass/.sass-cache

### Single Output

- **style.css (minified)**
  + sass assets/sass/style.scss:style.css --style compressed --sourcemap=none --no-cache

- **style.min.css**
  + sass assets/sass/style.scss:style.min.css --style compressed --sourcemap=none --no-cache