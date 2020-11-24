// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.scss';

const CourseLoop = function( props ) {
  const posts = props.data
  const templateName = props.templateName

  if( !posts || posts.length <= 0 ) return null;
  return (
    <>
      {
        posts.map( ( p, index ) => {
          let postHasThumb2Class = ''
          let postThumb2Html = ''
          if( templateName === 'symmetrical' && (index === 2 || index === 3) ) {
            postHasThumb2Class = p.thumb_url2 ? '__has-thumb2' : '';
            // eslint-disable-next-line
            postThumb2Html = p.thumb_url2 ? <a href={ p.post_url } className="thumb-background __thumb-2" style={ {background: `url(${ p.thumb_url2 }) no-repeat center center / cover, #222`} }></a> : '';
          }
          return (
            <div className="course-item" key={ p.ID }>
              <div className="post-inner">
                <div className={ [ 'post-thumb', postHasThumb2Class ].join( ' ' ) }>
                  <a href={ p.post_url } className="thumb-background" style={ {background: `url(${ p.thumb_url }) no-repeat center center / cover, #222`} }>
                    {/* <img src={ p.thumb_url } alt={ p.post_title } /> */}
                  </a>
                  {
                  // eslint-disable-next-line 
                  postThumb2Html 
                  }
                </div>
                <div className="post-entry">
                  <h4 className="post-title">
                    <a href={ p.post_url }>{ p.post_title }</a>
                  </h4>
                  <p>{ p.post_excerpt }</p>
                </div>
              </div>
            </div>
          )
        } )
      }
    </>
  )
}

class SenseiLMSCourses extends Component {

  static slug = 'dipp_senseilms_courses';

  render() {
    const posts = this.props.__posts
    
    return (
      <div className="pp-module-lms-course">
        <h2 className={ [ 'heading-text', `__heading-${ this.props.template }` ].join( ' ' ) } style={ { color: this.props.heading_text_color } }>{ this.props.heading }</h2>
        <div className={ [ 'pp-lms-course-list', `temp__${ this.props.template }` ].join( ' ' ) }>
          <CourseLoop data={ posts } templateName={ this.props.template } />
        </div>
      </div>
    );
  }
}

export default SenseiLMSCourses;
