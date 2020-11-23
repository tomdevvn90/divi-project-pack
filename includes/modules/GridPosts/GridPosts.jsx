// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
// import './style.scss';

const PostLoop = function( props ) {
  const posts = props.data
  if( !posts || posts.length <= 0 ) return null;
  return (
    <>
      {
        posts.map( ( p ) => {
          return (
            <div className="post-item" key={ p.ID }>
              <div className="post-inner">
                <div className="post-thumb">
                  <a href={ p.post_url } className="thumb-background" style={ {background: `url(${ p.thumb_url }) no-repeat center center / cover, #222`} }>
                    {/* <img src={ p.thumb_url } alt={ p.post_title } /> */}
                  </a>
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

class DPP_GridPosts extends Component {

  static slug = 'dipp_grid_posts';

  render() {
    const posts = this.props.__posts
    const template = 'default'
    console.log( this.props )
    return (
      <div className="pp-module-grid-posts">
        <h2 className={ [ 'heading-text', `__heading-${ template }` ].join( ' ' ) } style={ { color: this.props.heading_text_color } }>{ this.props.heading }</h2>
        <div className={ [ 'pp-lms-course-list', `temp__${ template }` ].join( ' ' ) }>
          <PostLoop data={ posts } />
        </div>
      </div>
    );
  }
}

export default DPP_GridPosts;
