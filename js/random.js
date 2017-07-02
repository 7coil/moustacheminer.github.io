const random_html = document.getElementById('random');
const messages = [
	'I don\'t even know why I implemented random footers, I have nothing to put here.',
	'Some say moustacheminer.com was named after a famous block based building game \'Fortresscraft\', but this is simply not true.',
	'Too many subdomains makes your teeth go grey!',
	'Days since last weeb invasion: 0 days',
	'I\'m literally broke for running this website',
	'What\'s next? An online public Virtual Machine?',
	'Error 429: You are exceeding b1nzy\'s ratelimit',
	'The sun is a deadly lazer',
	'I\'m running out of DDR3 RAM',
	'Welcome to Moustacheminer Server Services'
];

random_html.innerHTML = messages[Math.floor(Math.random() * messages.length)]
