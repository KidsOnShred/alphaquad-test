<?php
/**
 * Example data for programming test
 *
 * Each element of the array contains an array representing a menu item.
 * Menu items are structured as follows:
 * <code>
 * array(
 *   'label'=>string (required)
 *   'url'=>string (optional)
 *   'enabled'=>boolean (optional - if not present assume true)
 *   'htmlOptions'=>array of attributes applied to the list item (optional)
 *   'linkOptions'=>array of additional attributes applied to the link (optional)
 *   'items'=>array of child menu items
 * )
 * </code>
 */
return array(
	array(
		'label'=>'First menu item',
		'url'=>'/',
	),
	
	array(
		'label'=>'Second menu item',
		'url'=>'/second',
		'items'=>array(
			array(
				'label'=>'Second-level menu item',
				'url'=>'/second/deeper-page',
				'htmlOptions'=>array(
					'class'=>'active',
				),
			),
			
			array(
				'label'=>'Special offers',
				'url'=>'/second/offers',
				'items'=>array(
					array(
						'label'=>'Accessory 123 - was £9.95 now £7.50',
						'url'=>'/accessories/123',
					),
					
					array(
						'label'=>'Product 456 - only £22.99',
						'url'=>'/products/456',
						'htmlOptions'=>array(
							'class'=>'active',
						),
					),
					
					array(
						'label'=>'Product 789 - only £37.99 (was £50)',
						'url'=>'/products/456',
					),
					
					array(
						'label'=>'Save £5 on all products',
						'url'=>'/offers/expired',
						'enabled'=>false,
					),
				),
			),
		),
	),
	
	array(
		'label'=>'External link',
		'url'=>'http://www.google.co.uk',
		'linkOptions'=>array(
			'rel'=>'nofollow',
		),
	),
	
	array(
		'label'=>'Last item',
	),
);
