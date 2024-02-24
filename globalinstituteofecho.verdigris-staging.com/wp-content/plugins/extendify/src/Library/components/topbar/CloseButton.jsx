import { __ } from '@wordpress/i18n';

export const CloseButton = ({ onClose }) => (
	<button
		className="block w-6 h-6 p-px bg-transparent cursor-pointer outline-none focus:shadow-none focus:ring-wp focus:ring-design-main text-inherit"
		type="button"
		onClick={onClose}
		data-test="modal-close-button"
		aria-label={__('Close', 'extendify-local')}>
		<svg
			style={{ fill: 'currentColor' }}
			xmlns="http://www.w3.org/2000/svg"
			viewBox="0 0 24 24">
			<path d="M13 11.8l6.1-6.3-1-1-6.1 6.2-6.1-6.2-1 1 6.1 6.3-6.5 6.7 1 1 6.5-6.6 6.5 6.6 1-1z" />
		</svg>
	</button>
);
