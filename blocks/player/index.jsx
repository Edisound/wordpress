/**
 * Registers a new block provided a unique name and an object defining its behavior.
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/block-api/#registering-a-block
 */
const {registerBlockType} = wp.blocks
/**
 * Retrieves the translation of text.
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/packages/packages-i18n/
 */
const {__} = wp.i18n
const {InputControl, RichText, AlignmentToolbar, BlockControls} = wp.editor

import { Fragment } from '@wordpress/element'
const { TextControl } = wp.components
import icons from './icons/icons.js'

registerBlockType('edisound/player', {
	title: __('Edisound Player', 'edisound'),
	category: 'embed',
	icon: icons.edisound,
	supports: {
		html: false
	},
	edit (props) {
		const { select, subscribe } = wp.data;

		// La fonction qui met à jour la valeur
		const onChangeContent = content => {
			props.setAttributes( { content } )
		}

		const onBlockLoad = content => {
			loadPlayerEdisound(true)
		}

		return (
			<Fragment>
				<BlockControls>
					<AlignmentToolbar
						value={ props.attributes.alignment }
						onChange={ alignment => props.setAttributes( { alignment } ) }
					/>
				</BlockControls>
				{props.isSelected ? ( // N'afficher le champ seulement si le bloc est actif
					 <div className={props.className}>
						 <TextControl
							 placeholder="1ec11851-c897-647a-a341-853a979ccbde"
							 value={props.attributes.content}
							 onChange={onChangeContent}
						 />
					 </div>
				) : (
					<>
						<div className="rwm-podcast-player" data-pid={props.attributes.content.trim()}>{__('Loading...')}</div>
						<img height="0" width="0" onLoad={ onBlockLoad } src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1' %3E%3Cpath d=''/%3E%3C/svg%3E"/>
					</>
				)}
			</Fragment>
		)
	},
	save (props) {
		return null
	}
})
