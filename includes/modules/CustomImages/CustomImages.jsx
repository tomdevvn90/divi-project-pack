// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.scss';


class CustomImages extends Component {

  static slug = 'dipp_custom_images';

  render() {
    const src = this.props.src;
    const bgColor = this.props.bg_color;
    console.log(this.props);
    return (
      <div className={`dipp-module-custom-images module-custom-images-${this.props.style}`}>
        <div className="wrapper-custom-images">
          <img src={src} alt="" />
          <div style={(() => {
					return {
						'backgroundColor': bgColor,						
					}
				})()}  className="bg-container"></div>
        </div>
      </div>
    );
  }
}

export default CustomImages;
