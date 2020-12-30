// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.scss';


class CustomHeading extends Component {

  static slug = 'dipp_custom_heading';

  render() {
    const heading = this.props.heading;
    return (
      <div className={`dipp-module-custom-heading module-heading-${this.props.style}`}>
        <div className="wrapper-heading-tag"><h2 style={(() => {
					return {
						'--size-default': this.props.module_font_size,
						'--size-tablet': this.props.module_font_size_tablet,
            '--size-mobile': this.props.module_font_size_phone,
            color: this.props.module_text_color,
            fontWeight: this.props.module_font.replaceAll('|',"")
					}
				})()} className="custom-heading-tag">{heading}</h2></div>
      </div>
    );
  }
}

export default CustomHeading;
