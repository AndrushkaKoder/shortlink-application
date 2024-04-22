export function renderHistory(data) {
	let list = document.querySelector('.links_list');
	list.innerHTML = '';
	
	data.forEach(item => {
		let li = document.createElement('li'),
			link = document.createElement('a');
		link.setAttribute('href', item.short_url);
		link.setAttribute('target', '_blank')
		link.textContent = item.short_url;
		li.append(link);
		list.append(li)
	})
}