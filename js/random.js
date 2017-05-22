const random_html = document.getElementById("random");
const messages = [
	"I don't even know why I implemented random footers, I have nothing to put here.",
	"Some say moustacheminer.com was named after a famous block based building game 'Fortresscraft', but this is simply not true.",
	"Too many subdomains makes your teeth go grey!",
	"Days since last weeb invasion: 0 days"
];

random_html.innerHTML = messages[Math.floor(Math.random() * messages.length)]
