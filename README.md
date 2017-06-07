Apache Markdown Handler
=================
A basic markdown handler for Apache that utilizes [erusev/parsedown](https://github.com/erusev/parsedown) and [erusev/parsedown-extra](https://github.com/erusev/parsedown-extra) for rendering markdown files in Apache.


## Installation
To install simply run ``composer install`` in the root of the apache markdown handler's directory this will pull the dependencies into your install. After that configuring is pretty simple you just need to add the following lines to the htaccess file in the root of your www root or into the vhost entry. Once that's done simply verify it's working by hitting a markdown file somewhere on your server.
```
Action markdown /path/to/markdown-handler/handler.php
AddHandler markdown .md
```

## Controlling the Browser Title
There are 3 ways the browser title is decided from the markdown:
1. Title meta data, you can define a title using the title meta data. For this to work the first line of your markdown must be like the following:
    ```md
    title: My Title
    ```
2. If the first line of the rendered markdown is an ``<h1>`` tag the value of that tag will be used.
3. If none of the above find a title then the file name is used, all dashes and underscores in the name are replaced with spaces, the file extension is removed and then each word is set to it's proper case. Meaning ``my-example-markdown.md`` would become ``My Example Markdown`` as the browser title.
