import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl, SelectControl, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

import './editor.css';
import './style.css';

registerBlockType('network/recent-posts', {
	apiVersion: 2,
	title: 'Netzwerk-Beiträge',
	icon: 'admin-site-alt3',
	category: 'text',
	supports: {
		html: false,
	},
	attributes: {
		number: { type: 'number', default: 5 },
		showImage: { type: 'boolean', default: true },
		imageSize: { type: 'string', default: 'medium' },
		showAuthor: { type: 'boolean', default: true },
		showBlog: { type: 'boolean', default: true },
		readMoreText: { type: 'string', default: 'Weiterlesen' },
		layout: { type: 'string', default: 'card' },
	},
	edit({ attributes, setAttributes }) {
		return (
			<>
				<InspectorControls>
					<PanelBody title="Anzeigeoptionen">
						<TextControl
							label="Anzahl Beiträge"
							value={ attributes.number }
							onChange={ val => setAttributes({ number: parseInt(val) }) }
						/>
						<ToggleControl
							label="Beitragsbild anzeigen"
							checked={ attributes.showImage }
							onChange={ val => setAttributes({ showImage: val }) }
						/>
						<SelectControl
							label="Bildgröße"
							value={ attributes.imageSize }
							options={[
								{ label: 'Small', value: 'thumbnail' },
								{ label: 'Medium', value: 'medium' },
								{ label: 'Large', value: 'large' },
							]}
							onChange={ val => setAttributes({ imageSize: val }) }
						/>
						<ToggleControl
							label="Autor anzeigen"
							checked={ attributes.showAuthor }
							onChange={ val => setAttributes({ showAuthor: val }) }
						/>
						<ToggleControl
							label="Blogname anzeigen"
							checked={ attributes.showBlog }
							onChange={ val => setAttributes({ showBlog: val }) }
						/>
						<TextControl
							label="Weiterlesen-Text"
							value={ attributes.readMoreText }
							onChange={ val => setAttributes({ readMoreText: val }) }
						/>
						<SelectControl
							label="Layout"
							value={ attributes.layout }
							options={[
								{ label: 'Card', value: 'card' },
								{ label: 'Grid', value: 'grid' },
							]}
							onChange={ val => setAttributes({ layout: val }) }
						/>
					</PanelBody>
				</InspectorControls>
				<p><strong>Netzwerk-Beiträge-Block</strong><br />Wird dynamisch im Frontend gerendert.</p>
			</>
		);
	},
	save() {
		// Wird ignoriert wegen render_callback in PHP
		return null;
	}
});

