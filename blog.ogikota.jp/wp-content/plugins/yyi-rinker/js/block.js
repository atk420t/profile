( function( blocks, editor, i18n, element, components, _ ) {
	var el = element.createElement;
    var RichText = editor.RichText;

	i18n.setLocaleData( window.gutenberg_rinker.localeData, 'gutenberg-rinker' );

	blocks.registerBlockType( 'rinkerg/gutenberg-rinker', {
		title: i18n.__( 'Rinker', 'gutenberg-rinker' ),
		icon: 'external',
		category: 'layout',
		attributes: {
            content: {
                type: 'array',
                source: 'children',
                selector: 'p',
            },
            alignment: {
                type: 'string',
                default: 'none',
            },
		},
		edit: function( props ) {
            var content = props.attributes.content;
            var alignment = props.attributes.alignment;
			var attributes = props.attributes;
			const clientId = props.clientId;

            function onChangeContent( newContent ) {
                props.setAttributes( { content: newContent } );
            }

            function onFocusContent( j ) {
                props.setAttributes( { content: j.target.value } );
            }

			return el( 'div', { className: props.className },[
                        el( 'div', { className: 'yyi_rinker-gutenberg' },
                            [
                                el(
                                    'input',
                                    {
                                        tagName: 'p',
                                        className: 'rinkerg-richtext',
                                        onFocus: onFocusContent,
                                        onClick: onFocusContent,
                                        onChange: onFocusContent,
                                        formattingControls: [],
                                        value: content
                                    }
                                ),
                                el(
                                    'button', {
                                        href: 'http://rinker.test/wp-admin/media-upload.php?&type=yyi_rinker&tab=yyi_rinker_search_amazon&from=yyi_rinker&TB_iframe=true',
                                        className: 'button thickbox add_media',
                                        onClick: function(j) {
                                            var url = 'media-upload.php?type=yyi_rinker&tab=yyi_rinker_search_amazon&cid=' + clientId + '&TB_iframe=true';
                                            tb_show('商品リンク追加', url);
                                        }
                                    },
                                    '商品リンク追加'

                                ),
                            ]
                        )
                    ]
				);
		},
		save: function( props ) {
            return el( RichText.Content, {
                tagName: 'p',
                className: 'gutenberg-yyi-rinker' + props.attributes.alignment,
                value: props.attributes.content
            } );
		}
	} );

} (
	window.wp.blocks,
	window.wp.editor,
	window.wp.i18n,
	window.wp.element,
	window.wp.components,
	window._
) );

