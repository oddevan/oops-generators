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
]
```

Add the configuration:

```json
"extra": {
	"oopsgen": {
		"base_namespace": "Smolblog\\WP\\",
		"base_dir": "plugins/smolblog-wp/src/"
	}
}
```

(these should correspond to your autoloader)

And add the script handler:

```json
"scripts": {
	"oopsgen": "oddevan\\oopsGenerators\\Main::go"
}
```

Then just type `composer oopsgen` to read the help text and start going!

---

Pull requests welcome. Please.
