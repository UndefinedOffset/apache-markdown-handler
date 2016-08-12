Apache Markdown Handler
=================
A basic markdown handler for Apache that utilizes [erusev/parsedown](https://github.com/erusev/parsedown) and [erusev/parsedown-extra](https://github.com/erusev/parsedown-extra) for rendering markdown files in Apache.


## Installation
To install simply run ``composer install`` in the root of the apache markdown handler's directory this will pull the dependencies into your install. After that configuring is pretty simple you just need to add the following lines to the htaccess file in the root of your www root or into the vhost entry. Once that's done simply verify it's working by hitting a markdown file somewhere on your server.
```
Action markdown /path/to/markdown-handler/handler.php
AddHandler markdown .md
```