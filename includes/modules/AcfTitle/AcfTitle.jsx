// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import '../style.css';


class AcfTitle extends Component {

	static slug = 'acf_title_module';

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
		const titleBeforeAcf	= this.props.title_before_acf;
		const titleAfterAcf = this.props.title_after_acf;
		const tagName = this.props.tag_type;
		const useTitle = this.props.use_title;
		const acfTitle = useTitle === 'on' ? this.props.acf_of_title : this.props.acf_of_title_text;
		const acfTitle2 = useTitle === 'on' ? '' : this.props.acf_of_title2_text;

		const useBullet = this.props.use_bullet;
		const bulletType = this.props.bullet_type;
		const bulletNumber = this.props.bullet_number

		// const form_type = this.props.form_type;
		let output = '';
		if (useBullet === 'off') {
			switch (tagName) {
				case 'p':
					output = (
						<div className="acf-title-container">
							<p className="title-style">
								<span className="before-title-style">
									{titleBeforeAcf}
								</span>
								{acfTitle}
								<span className="after-title-style">
									{titleAfterAcf}
								</span>
								<span className="title2-style">
									{acfTitle2}
								</span>
							</p>
						</div>
					);
					break;
				case 'h1':
					output = (
						<div className="acf-title-container">
							<h1 className="title-style">
								<span className="before-title-style">
									{titleBeforeAcf}
								</span>
								{acfTitle}
								<span className="after-title-style">
									{titleAfterAcf}
								</span>
								<span className="title2-style">
									{acfTitle2}
								</span>
							</h1>
						</div>
					);
					break;
				case 'h2':
					output = (
						<div className="acf-title-container">
							<h2 className="title-style">
								<span className="before-title-style">
									{titleBeforeAcf}
								</span>
								{acfTitle}
								<span className="after-title-style">
									{titleAfterAcf}
								</span>
								<span className="title2-style">
									{acfTitle2}
								</span>
							</h2>
						</div>
					);
					break;
				case 'h3':
					output = (
						<div className="acf-title-container">
							<h3 className="title-style">
								<span className="before-title-style">
									{titleBeforeAcf}
								</span>
								{acfTitle}
								<span className="after-title-style">
									{titleAfterAcf}
								</span>
								<span className="title2-style">
									{acfTitle2}
								</span>
							</h3>
						</div>
					);
					break;
				default:
					output = (
						<div className="acf-title-container">
							<p className="title-style">
								<span className="before-title-style">
									{titleBeforeAcf}
								</span>
								{acfTitle}
								<span className="after-title-style">
									{titleAfterAcf}
								</span>
								<span className="title2-style">
									{acfTitle2}
								</span>
							</p>
						</div>
					);
					break;
			}
		} else {
			if (bulletType === 'circle') {
				switch (tagName) {
					case 'p':
						output = (
							<div>
								<p styleName="float:left" className="bullet-circle">
									<span className="bullet-style">{bulletNumber}</span>
								</p>
								<p className="title-style">
									<span className="before-title-style">{titleBeforeAcf}</span>
									{acfTitle}
									<span className="after-title-style">{titleAfterAcf}</span>
								</p>
							</div>
						);
						break;
					case 'h1':
						output = (
							<div>
								<h1 styleName="float:left" className="bullet-circle">
									<span className="bullet-style">{bulletNumber}</span>
								</h1>
								<h1 className="title-style">
									<span className="before-title-style">{titleBeforeAcf}</span>
									{acfTitle}
									<span className="after-title-style">{titleAfterAcf}</span>
								</h1>
							</div>
						);
						break;
					case 'h2':
						output = (
							<div>
								<h2 styleName="float:left" className="bullet-circle">
									<span className="bullet-style">{bulletNumber}</span>
								</h2>
								<h2 className="title-style">
									<span className="before-title-style">{titleBeforeAcf}</span>
									{acfTitle}
									<span className="after-title-style">{titleAfterAcf}</span>
								</h2>
							</div>
						);
						break;
					case 'h3':
						output = (
							<div>
								<h3 styleName="float:left" className="bullet-circle">
									<span className="bullet-style">{bulletNumber}</span>
								</h3>
								<h3 className="title-style">
									<span className="before-title-style">{titleBeforeAcf}</span>
									{acfTitle}
									<span className="after-title-style">{titleAfterAcf}</span>
								</h3>
							</div>
						);
						break;
					default:
						output = (
							<div>
								<p styleName="float:left" className="bullet-circle">
									<span className="bullet-style">{bulletNumber}</span>
								</p>
								<p className="title-style">
									<span className="before-title-style">{titleBeforeAcf}</span>
									{acfTitle}
									<span className="after-title-style">{titleAfterAcf}</span>
								</p>
							</div>
						);
						break;
				}
			} else {
				switch (tagName) {
					case 'p':
						output = (
							<div>
								<p styleName="float:left">
									<span className="bullet-style">{bulletNumber}</span>
								</p>
								<p className="title-style">
									<span className="before-title-style">{titleBeforeAcf}</span>
									{acfTitle}
									<span className="after-title-style">{titleAfterAcf}</span>
								</p>
							</div>
						);
						break;
					case 'h1':
						output = (
							<div>
								<h1 styleName="float:left">
									<span className="bullet-style">{bulletNumber}</span>
								</h1>
								<h1 className="title-style">
									<span className="before-title-style">{titleBeforeAcf}</span>
									{acfTitle}
									<span className="after-title-style">{titleAfterAcf}</span>
								</h1>
							</div>
						);
						break;
					case 'h2':
						output = (
							<div>
								<h2 styleName="float:left">
									<span className="bullet-style">{bulletNumber}</span>
								</h2>
								<h2 className="title-style">
									<span className="before-title-style">{titleBeforeAcf}</span>
									{acfTitle}
									<span className="after-title-style">{titleAfterAcf}</span>
								</h2>
							</div>
						);
						break;
					case 'h3':
						output = (
							<div>
								<h3 styleName="float:left">
									<span className="bullet-style">{bulletNumber}</span>
								</h3>
								<h3 className="title-style">
									<span className="before-title-style">{titleBeforeAcf}</span>
									{acfTitle}
									<span className="after-title-style">{titleAfterAcf}</span>
								</h3>
							</div>
						);
						break;
					default:
						output = (
							<div>
								<p styleName="float:left">
									<span className="bullet-style">{bulletNumber}</span>
								</p>
								<p className="title-style">
									<span className="before-title-style">{titleBeforeAcf}</span>
									{acfTitle}
									<span className="after-title-style">{titleAfterAcf}</span>
								</p>
							</div>
						);
						break;
				}
			}
		}
		return output;
	}

	render() {
		return (
			<div>
				{this._renderHTML()}
			</div>
		);
	}
}

export default AcfTitle;
