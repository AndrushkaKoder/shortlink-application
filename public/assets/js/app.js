import {removeAlert} from "./modules/alert.js";
import {renderHistory} from "./modules/renderHistory.js";
import axios from 'https://cdn.jsdelivr.net/npm/axios@1.3.5/+esm';


function sendLink() {
	let form = document.querySelector('.links_form');
	if (form) {
		form.addEventListener('submit', (event) => {
			let userId = form.getAttribute('data-user')
			let input = form.querySelector('input');
			event.preventDefault();
			axios.post('http://shortlink.loc/store', {id: userId ?? null, link: input.value})
				.then((res) => {
					if (res.status === 200) {
						input.value = '';
						axios.get(`http://shortlink.loc/get_links?id=${userId}`).then((resp) => {
							if (resp.status === 200) {
								renderHistory(resp.data)
							}
						})
					}
				})
				.catch((rej) => {
					input.classList.add('invalid')
					console.error(rej.message)
				})
		})
	}
}

removeAlert();
sendLink();


