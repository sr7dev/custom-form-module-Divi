// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import '../style.css';


class ShortForm extends Component {

	static slug = 'mrc_short_form';

	_renderForm(){
		const content = this.props.content;
		const form_id = this.props.form_id;
		const input_id = this.props.input_id;
		const button_id = this.props.submit_button_id;
		const submit_button_text = this.props.submit_button_text;
		const mrc_short_form_num = this.props.mrc_short_form_num;
		
		let output = (
			<div class="acf_short">
					<form class="mrc_short_form clearfix" method="post" id={form_id}>
						{content}
						<input type="hidden" value="et_contact_proccess" name={"acf_shortform_submit_" + mrc_short_form_num} />
						<input type="text" value="" name={"acf_shortform_validate_" + mrc_short_form_num} class="acf_shortform_validate_field" id={input_id} placeholder="Enter ZIP"/>
						<div class="acf_button_container">
							<button	id={button_id} type="submit" class="mrc_short_submit acf_button">{submit_button_text}</button>
						</div>
					</form>
				</div> 
		);

		return output;
	}

	render() {
		// const mrc_short_form_num = this.props.mrc_short_form_num;
		// const module_id = '' !== this.module_id(false) ? this.module_id(false) : 'mrc_short_form_' + mrc_short_form_num;
		
		// const Content = this.props.content;
		return (
			<div class="mrc_short_form_container clearfix">
				{this._renderForm()}
			</div>
		);
	}
}

export default ShortForm;
