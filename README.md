# Generators for OOPS-WP

Generate basic scaffolding for an [OOPS-WP](https://github.com/WebDevStudios/oops-wp) plugin.

## Installation

### In your `composer.json`

Add this repo:

```json
"repositories":[
	{
		"type": "vcs",
		"url": "https://github.com/oddevan/oops-generators"
	}
],
"require": {
	"oddevan/oops-generators": "dev-master"
}
```

Make sure your `composer.json` has the necessary info, especially your `psr-4` autoloader:

```json
"name": "smolblog/smolblog-wp",
"description": "Bigger than micro, smaller than medium.",
"version": "0.1.0",
"authors": [
	{
		"name": "Evan Hildreth",
		"email": "me@eph.me",
		"homepage": "http://eph.me",
		"role": "Developer"
	}
],
"autoload": {
	"psr-4": {
		"Smolblog\\WP\\": "plugins/smolblog-wp/src/"
	}
}
```

Add the configuration:

```json
"extra": {
	"oopsgen": {
		"text-domain": "smolblog-wp"
	}
}
```

And add the script handler:

```json
"scripts": {
	"oopsgen": "oddevan\\oopsGenerators\\Main::go"
}
```

Then just type `composer oopsgen` to read the help text and start going!

---

Pull requests welcome. Please.
