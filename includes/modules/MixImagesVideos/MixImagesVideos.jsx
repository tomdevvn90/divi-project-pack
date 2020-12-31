// External Dependencies
import React, { Component } from 'react';


// Internal Dependencies
import './style.scss';


class MixImagesVideos extends Component {

  static slug = 'dipp_mix_images_videos';

  render() {
    const heading = this.props.heading;
    const description = this.props.description;
    const src_video = this.props.src_video;
    const src_img_1 = this.props.src_img_1;
    const src_img_2 = this.props.src_img_2;
    return (
      <div className="dipp-module-mix-image-videos">
        <div className="wrapper-content-mix-images-videos">
          <div className="content-rows">
            <div className="mix-images-videos-col">
              <div className="title-header">
                <h2>{heading}</h2>
              </div>
              <div claclassNamess="desc-content">{description}</div>
            </div>
            <div className="mix-images-videos-col">
              <div className="wrap-videos">
                <video
                  autoPlay
                  src={this.props.src_video} />
              </div>
            </div>
          </div>
          <div className="wrap-images">
            <div className="module-mix-images mix-images-1">
              <img src={src_img_1} alt="image 1" />
            </div>
            <div className="module-mix-images mix-images-2">
              <img src={src_img_2} alt="image 2" />
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default MixImagesVideos;
