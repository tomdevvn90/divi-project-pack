// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.scss';


class BoxText extends Component {

  static slug = 'dipp_box_text';

  render() {
    const heading = this.props.heading;
    const description = this.props.description;
    const color_text = this.props.color_text;
    const bg_color = this.props.bg_color;
    const space_bottom = this.props.space_bottom;
    return (
      <div className="dipp-module-box-text">
        <div class={`wrapper-box-text style-color-text-${color_text}`} style={{backgroundColor: bg_color,paddingBottom: space_bottom}}>
          <h3 class="heading-box">{heading}</h3>
          <div class="desc-box">{description}</div>
        </div>
      </div>
    );
  }
}

export default BoxText;
