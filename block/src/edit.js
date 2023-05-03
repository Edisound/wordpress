/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
import { useBlockProps } from '@wordpress/block-editor';

import { TextControl } from '@wordpress/components';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit(props) {
	const { content } = props.attributes

	const onChangeContent = content => {
		props.setAttributes( { content } )
	}

	const onBlockLoad = ()=> {
		if (typeof Amplitude !== "undefined") {
			Amplitude.stop();
			loadPlayerEdisound(false);
		}
		else if (typeof loadPlayerEdisound == "function") {
			loadPlayerEdisound(true);
		}
	}

	return (
		<p { ...useBlockProps() }>
			{ (props.isSelected || (typeof content == "undefined") || content.trim() === "") ? (
				<div>
					<TextControl
						placeholder="1ec11851-c897-647a-a341-853a979ccbde"
						value={content}
						onChange={onChangeContent}
					/>
				</div>
			) : (
				<div>
					<div className="rwm-podcast-player" data-pid={content.trim()} data-preview="1">{__('Loading...', 'edisound')}</div>
					<img onLoad={ onBlockLoad } height="0" width="0"  src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1' %3E%3Cpath d=''/%3E%3C/svg%3E"/>
				</div>
			)}
		</p>
	);
}
