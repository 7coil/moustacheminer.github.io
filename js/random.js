const random_html = document.getElementById('random');
const messages = [
	'Motor Sports Streams',
	'Maximum Segment Size',
	'Ministry for State Security',
	'Merseyside Skeptics Society',
	'Manufacturers Standardisation Society',
	'Midland Secondary School',
	'Master of Strategic Studies',
	'Microsoft Search Server',
	'Marshall-Smith syndrome',
	'Microsatellite stability',
	'Multispectral Scanner',
	'Mobile-satellite service',
	'Managed Security Services',
	'Mass Storage System',
	'Microsoft Smooth Streaming',
	'Miles Sound System',
	'Modern Shetlandic Scots',
	'Modular Sleep System',
	'Managed Security Services',
	'Management Support System',
	'Marske Site Services'
];

random_html.innerHTML = messages[Math.floor(Math.random() * messages.length)]
