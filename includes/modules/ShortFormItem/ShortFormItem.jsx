// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import '../style.css';


class ShortFormItem extends Component {

	static slug = 'mrc_short_field';

	_renderItem(){
		const field_type = this.props.field_type;
		const current_module_num = this.props.current_module_num;
		const field_id = this.props.field_id;
		const required_mark = this.props.required_mark;
		const field_title = this.props.field_title;

		let output = '';
		switch( field_type ) {
			case 'datepicker':
				output = (<input type="date" required></input>);
				break;
			case 'gendersel':
				output = (
					<div class="switch-field">
						<input type="radio" id="radio-male" name="switch-one" value="male"/>
						<label for="radio-male">Male</label>
						<input type="radio" id="radio-female" name="switch-one" value="female" />
						<label for="radio-female">Female</label>
					</div>
				);
				break;
			case 'label':
				output = (
					<label 
						name={"mrc_short_" + field_id + "_" + current_module_num}
						id={"mrc_short_" + field_id + "_" + current_module_num}
						class="mrc_short_message input" 
						data-required_mark={'off' === required_mark ? 'not_required' : 'required'} 
						data-field_type={field_type} 
						data-original_id={field_id}
					>
						{field_title}
					</label>
				);
				break;
			case 'radio':
				var input_field = (
					<span class="mrc_short_field_radio">
					</span>
				);
				output = (
					<span class="mrc_short_field_options_wrapper">
						<span class="mrc_short_field_options_title">{field_title}</span>
						<span class="mrc_short_field_options_list">{input_field}</span>
					</span>
				);
				break;
			case 'select':
				output = (
					<select 
						id={"mrc_short_" + field_id + "_" + current_module_num} 
						class="mrc_short_select input" 
						name={"mrc_short_" + field_id + "_" + current_module_num} 
						data-required_mark={required_mark}
						data-field_type={field_type} 
						data-original_id={field_id}
					>
						<option value="">{field_title}</option>
					</select>
				);
				break;
			default:
				break;
		}
		return output;
	}

	render() {
		const field_type = this.props.field_type;
		const current_module_num = this.props.current_module_num;
		const field_id = this.props.field_id;
		const field_title = this.props.field_title;

		return (
			<p class="error-message" data-id={field_id} data-type={field_type}>
				<label for={"mrc_short_" + field_id + "_" + current_module_num} class="mrc_short_form_label">{field_title}</label>
				{this._renderItem()}
			</p>
		);
	}
}

export default ShortFormItem;
