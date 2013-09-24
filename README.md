# Countries

Useful information about every country, packaged as objects. Created from the [countries ruby gem](https://github.com/hexorx/countries/).

## Usage

Return an array of country names. [[test]](?return[]=name)

```html
<script src="?return[]=name"></script>
```

```js
[{"name":"Andorra"},{"name":"United Arab Emirates"},...]
```

Return a keyless array of country names. [[test]](?return[]=name&keyless)

```html
<script src="?return[]=name&keyless"></script>
```

```js
[["Andorra"],["United Arab Emirates"],...]
```

Return a callback array of country names. [[test]](?return[]=name&callback=foo)

```html
<script src="?return[]=name&callback=foo"></script>
```

```js
foo([["Andorra"],["United Arab Emirates"],...]);
```

Return a human-readable array of country names. [[test]](?return[]=name&readable)

```html
<script src="?return[]=name&readable"></script>
```

```js
[
	{
		"name": "Andorra"
	},
	{
		"name": "United Arab Emirates"
	},
	...
]
```

Return an array of country names and their ISO 3166 Alpha 2 codes. [[test]](?return[]=name&return[]=alpha2)

```html
<script src="?return[]=name&return[]=alpha2"></script>
```

```js
[{"name":"Andorra","alpha2":"AD"},{"name":"United Arab Emirates","alpha2":"AE"},...]
```

Return an array of one item — the United State’s name and latitude–longitude coordinates. [[test]](?alpha2[]=US&return[]=name&return[]=latlng)

```html
<script src="?alpha2[]=US&return[]=name&return[]=latlng"></script>
```

```js
[{"name":"United States","latlng":[38,-97]}]
```

Return an object — the United State’s name and latitude–longitude coordinates. [[test]](?alpha2=US&return[]=name&return[]=latlng)

```html
<script src="?alpha2=US&return[]=name&return[]=latlng"></script>
```

```js
{"name":"United States","latlng":[38,-97]}
```

Return an array of all countries’ data. [[test]](?return)

```html
<script src="?return"></script>
```

```js
[{"addressFormat":null,"alpha2":"AD",...},...]
```


## License

Data taken from the [countries ruby gem](//github.com/hexorx/countries) is licensed MIT. Any additional data and everything else is dedicated to the [public domain (CC0)](//creativecommons.org/publicdomain/zero/1.0/).