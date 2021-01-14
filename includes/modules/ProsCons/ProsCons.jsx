// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.scss';

class ProsCons extends Component {

  static slug = 'dipp_pros_cons';

  render() {
    
    const pros_heading =  this.props.pros_heading;  
    const pros_content =  this.props.pros_content;
    const cros_heading =  this.props.cros_heading;
    const cons_content =  this.props.cons_content;
    return (
      <div className="dipp-module-pros-cons">

        <div className="wrapper-content-pros-cons">
            <div className="item-wrapper item-pros">
                <h2 className="bt-tilte"> {pros_heading} </h2>
                
                <div className="bt-content" dangerouslySetInnerHTML={{__html: pros_content}}></div>
            </div>
            <div className="item-wrapper item-cons">
                <h2 className="bt-tilte"> {cros_heading} </h2>
                <div className="bt-content" dangerouslySetInnerHTML={{__html: cons_content}}></div>
            </div>
        </div>

      </div>
    );
  }
}

export default ProsCons;
