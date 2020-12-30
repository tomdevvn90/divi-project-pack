// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.scss';


class MemberTeam extends Component {

  static slug = 'dipp_member_team';

  render() {
    const src = this.props.src;
    const name = this.props.name;
    const position = this.props.position;
    const email = this.props.email;
    return (
      <div className="dipp-module-member-team">
        <div className="wrapper-content-team-member">
          <div className="img-member" style={{backgroundImage: `url(${src})`}}></div>          
          <h5 className="name-member">{name}</h5>
          <p className="position-member">{position}</p>
          <p className="email-member">{email}</p>
        </div>
      </div>
    );
  }
}

export default MemberTeam;
