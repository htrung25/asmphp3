<!-- Client Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>

<!-- Toast container -->
<div id="global-toast" style="position:fixed;top:20px;right:20px;z-index:2000;display:none;"></div>

<script>
// Helper: show toast message
function showToast(message, timeout = 2500) {
	const container = document.getElementById('global-toast');
	if (!container) return;
	container.style.display = 'block';
	const el = document.createElement('div');
	el.className = 'alert alert-success shadow';
	el.style.minWidth = '200px';
	el.innerText = message;
	container.appendChild(el);
	setTimeout(() => {
		el.classList.add('fade');
		setTimeout(() => { container.removeChild(el); if (!container.children.length) container.style.display='none'; }, 300);
	}, timeout);
}

// Update cart badge
function updateCartBadge(count) {
	const badge = document.getElementById('cart-count-badge');
	if (!badge) return;
	if (typeof count === 'undefined') return;
	badge.textContent = count;
	if (parseInt(count) > 0) {
		badge.style.display = '';
	} else {
		badge.style.display = 'none';
	}
}

// Attach AJAX handler to add-to-cart forms
document.addEventListener('DOMContentLoaded', function() {
	// fetch CSRF token
	const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

	document.querySelectorAll('form.ajax-add-cart').forEach(form => {
		form.addEventListener('submit', function(e) {
			e.preventDefault();
			const url = form.getAttribute('action') || window.location.href;
			const formData = new FormData(form);

			fetch(url, {
				method: 'POST',
				headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
				body: formData,
			}).then(r => {
				if (r.status === 401) {
					// Not authenticated — redirect to login page and preserve current location
					const loginUrl = '{{ route('login') }}' + '?redirect=' + encodeURIComponent(window.location.href);
					window.location = loginUrl;
					return Promise.reject('unauthenticated');
				}
				return r.json();
			})
			  .then(data => {
				  if (data && data.success) {
					  updateCartBadge(data.count ?? 0);
					  showToast(data.message || 'Đã thêm vào giỏ hàng');
					  // redirect if form has data-redirect="cart" or hidden redirect_to=cart
					  const redirect = form.dataset.redirect || form.querySelector('input[name="redirect_to"]')?.value;
					  if (redirect === 'cart') {
						  window.location = '{{ route('cart.index') }}';
					  }
				  } else {
					  showToast('Không thể thêm vào giỏ hàng', 2500);
				  }
			  }).catch(err => {
				  if (err === 'unauthenticated') return;
				  console.error(err);
				  showToast('Lỗi mạng, thử lại sau', 2500);
			  });
		});
	});

	// quantity +/- buttons behavior
	document.querySelectorAll('.qty-control').forEach(wrapper => {
		const btnMinus = wrapper.querySelector('.qty-minus');
		const btnPlus = wrapper.querySelector('.qty-plus');
		const input = wrapper.querySelector('input[type="number"].product-qty');
		if (!input) return;
		btnMinus && btnMinus.addEventListener('click', (e) => {
			e.preventDefault();
			let v = parseInt(input.value) || 1; v = Math.max(parseInt(input.min || 1), v - 1); input.value = v;
		});
		btnPlus && btnPlus.addEventListener('click', (e) => {
			e.preventDefault();
			let v = parseInt(input.value) || 1; v = Math.min(parseInt(input.max || 9999), v + 1); input.value = v;
		});
	});
});

// Client-side simple required-field validation for login/register
document.addEventListener('DOMContentLoaded', function() {
	document.querySelectorAll('form.client-validate').forEach(form => {
		form.addEventListener('submit', function(e) {
			// Clear previous client errors
			form.querySelectorAll('.client-error').forEach(el => { el.classList.remove('d-block'); el.style.display = 'none'; el.textContent = ''; });

			let hasError = false;
			// check required inputs
			form.querySelectorAll('input, textarea, select').forEach(el => {
				if (el.hasAttribute('required')) {
					const val = (el.value || '').toString().trim();
					if (val === '') {
						hasError = true;
						// find corresponding error container by data-for attribute
						const key = el.getAttribute('name') || el.getAttribute('id');
						const container = form.querySelector('.client-error[data-for="' + key + '"]') || form.querySelector('.client-error[data-for="' + el.id + '"]');
						if (container) {
							container.textContent = 'Vui lòng nhập ' + (el.getAttribute('aria-label') || key || 'trường này') + '.';
							container.classList.add('d-block');
							container.style.display = '';
						} else {
							// fallback: append a bootstrap invalid-feedback element after the field
							const msg = document.createElement('div');
							msg.className = 'invalid-feedback d-block client-error mt-1';
							msg.textContent = 'Vui lòng nhập trường này.';
							el.insertAdjacentElement('afterend', msg);
						}
						// mark the input invalid for styling
						el.classList.add('is-invalid');
					}
				}
			});

			if (hasError) {
				e.preventDefault();
				// focus first invalid
				const first = form.querySelector('.is-invalid');
				if (first) first.focus();
			}
		});

		// clear client error when user types
		form.querySelectorAll('input, textarea').forEach(el => {
			el.addEventListener('input', function() {
				const container = form.querySelector('.client-error[data-for="' + (el.getAttribute('name') || el.id) + '"]');
				if (container) { container.classList.remove('d-block'); container.style.display = 'none'; container.textContent = ''; }
				el.classList.remove('is-invalid');
			});
		});
	});
});
</script>

{{-- Nếu sau này có thêm JS chung thì để đây --}}
@stack('scripts')