// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import '../style.css';


class AcfZipForm extends Component {
	static slug = 'acf_zip_form';

	static css(props) {
		const utils = window.ET_Builder.API.Utils;
		const additionalCss = [];

		if (props.text_align) {
			additionalCss.push([{
				selector: '%%order_class%%.typography-fields',
				declaration: `text-align: ${props.text_align};`,
			}]);
		}

		if (props.select_font) {
			additionalCss.push([{
				selector: '%%order_class%%.typography-fields',
				declaration: utils.setElementFont(props.select_font),
			}]);
		}

		if (props.color) {
			additionalCss.push([{
				selector: '%%order_class%%.colorpicker-preview.color',
				declaration: `background-color: ${props.color};`,
			}]);
		}

		if (props.color_alpha) {
			additionalCss.push([{
				selector: '%%order_class%%.colorpicker-preview.color-alpha',
				declaration: `background-color: ${props.color_alpha};`,
			}]);
		}
	}

	_renderHTML() {
		// const utils = window.ET_Builder.API.Utils;
		const submitButtonText = this.props.submit_button_text;
		const formId = this.props.form_id;
		const actionUrl = this.props.action_url;

		let output = '';
		let inputID = 'input_' + formId;
		let buttonID = 'button_' + formId;

		output = (
			<form
				className="acf_zip_form clearfix acf_zip_form_container"
				target="_self"
				method="post"
				action={actionUrl}
				id={formId}
			>
				<input
					type="hidden"
					value="et_contact_proccess"
				/>
				<input
					name="fields[zip][value]"
					className="acf_zip_form_validate_field"
					id={inputID}
					pattern="\d{5}"
					type="tel"
					placeholder="Enter ZIP"
				/>
				<div className="acf_button_container">
					<button
						id={buttonID}
						type="submit"
						className="acf_zip_submit acf_button"
					>
						{submitButtonText}
					</button>
				</div>
			</form>
		);

		return output;
	}

	render() {
		return (
			<h1>
				{this._renderHTML()}
			</h1>
		);
	}
}

export default AcfZipForm;
