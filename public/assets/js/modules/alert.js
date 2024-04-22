export function removeAlert() {
	let alertMessage = document.querySelector('.alert-danger');
	if (alertMessage) {
		setTimeout(() => {
			alertMessage.remove();
		}, 3000)
	}
}