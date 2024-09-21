<?php

add_action('acf/init', 'register_acf_fields_for_real_estate_pro_version');

function register_acf_fields_for_real_estate_pro_version()
{
	if (function_exists('acf_add_local_field_group')) {

		acf_add_local_field_group(array(
			'key' => 'group_real_estate_object',
			'title' => 'Об\'єкт нерухомості',
			'fields' => array(
				// Building Fields
				array(
					'key' => 'field_building_name',
					'label' => 'Назва будинку',
					'name' => 'building_name',
					'type' => 'text',
					'required' => 1,
				),
				array(
					'key' => 'field_location_coordinates',
					'label' => 'Координати місцезнаходження',
					'name' => 'location_coordinates',
					'type' => 'text',
					'required' => 1,
				),
				array(
					'key' => 'field_number_of_floors',
					'label' => 'Кількість поверхів',
					'name' => 'number_of_floors',
					'type' => 'select',
					'choices' => array_combine(range(1, 20), range(1, 20)),
					'required' => 1,
				),
				array(
					'key' => 'field_building_type',
					'label' => 'Тип будівлі',
					'name' => 'building_type',
					'type' => 'radio',
					'choices' => array(
						'panel' => 'Панель',
						'brick' => 'Цегла',
						'foam_block' => 'Піноблок',
					),
					'required' => 1,
				),
				array(
					'key' => 'field_environmental_rating',
					'label' => 'Екологічність',
					'name' => 'environmental_rating',
					'type' => 'select',
					'choices' => array_combine(range(1, 5), range(1, 5)),
					'required' => 1,
				),
				array(
					'key' => 'field_building_image',
					'label' => 'Зображення будинку',
					'name' => 'building_image',
					'type' => 'image',
					'required' => 1,
					'return_format' => 'url',
					'preview_size' => 'medium',
					'library' => 'all',
				),

				// Repeater Field for Premises
				array(
					'key' => 'field_premises',
					'label' => 'Приміщення',
					'name' => 'premises',
					'type' => 'repeater',
					'button_label' => 'Додати Приміщення',
					'sub_fields' => array(
						array(
							'key' => 'field_premise_area',
							'label' => 'Площа',
							'name' => 'premise_area',
							'type' => 'text',
						),
						array(
							'key' => 'field_number_of_rooms',
							'label' => 'Кількість кімнат',
							'name' => 'number_of_rooms',
							'type' => 'radio',
							'choices' => array_combine(range(1, 10), range(1, 10)),
						),
						array(
							'key' => 'field_balcony',
							'label' => 'Балкон',
							'name' => 'balcony',
							'type' => 'radio',
							'choices' => array(
								'yes' => 'Так',
								'no' => 'Ні',
							),
						),
						array(
							'key' => 'field_bathroom',
							'label' => 'Санвузол',
							'name' => 'bathroom',
							'type' => 'radio',
							'choices' => array(
								'yes' => 'Так',
								'no' => 'Ні',
							),
						),
						array(
							'key' => 'field_premise_image',
							'label' => 'Зображення',
							'name' => 'premise_image',
							'type' => 'image',
							'return_format' => 'url',
							'preview_size' => 'medium',
							'library' => 'all',
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'real_estate_object',
					),
				),
			),
			'style' => 'default',
			'position' => 'acf_after_title',
		));
	}
}
