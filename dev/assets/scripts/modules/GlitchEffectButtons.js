import gsap from '../../../../node_modules/gsap/src/uncompressed/TimelineMax';

// Glitch Timeline Function
function glitchEffectButtons() {
  var text = document.querySelector('.btn-glitch-active'),
      filter = document.querySelector('.svg-sprite'),
      turb = filter.querySelector('#filter feTurbulence'),
      turbVal = { val: 0.000001 },
      turbValX = { val: 0.000001 };

  var glitchTimeline = function() {
      var timeline = new TimelineMax({
          repeat: -1,
          repeatDelay: 2,
          paused: true,
          onUpdate: function () {
              turb.setAttribute('baseFrequency', turbVal.val + ' ' + turbValX.val);
          }
      });

      timeline
          .to(turbValX, 0.1, { val: 0.5 })
          .to(turbVal, 0.1, { val: 0.02 });
      timeline
          .set(turbValX, { val: 0.000001 })
          .set(turbVal, { val: 0.000001 });
      timeline
          .to(turbValX, 0.2, { val: 0.4 }, 0.4)
          .to(turbVal, 0.2, { val: 0.002 }, 0.4);
      timeline
          .set(turbValX, { val: 0.000001 })
          .set(turbVal, { val: 0.000001 });

      return {
          start: function() {
              timeline.play(0);
          },
          stop: function() {
              timeline.pause();
          }
      };
  };


  var btnGlitch = new glitchTimeline(),
      btnGlitchElements = document.querySelectorAll('.btn-glitch');

  btnGlitchElements.forEach(function(btn) {
    btn.addEventListener('mouseenter', function() {
      this.classList.add('btn-glitch-active');
      btnGlitch.start();
    })

    btn.addEventListener('mouseleave', function() {

      if ( btn.classList.contains('btn-glitch-active') ) {
        btn.classList.remove('btn-glitch-active');
        btnGlitch.stop();
      }
    })
  });
}
  

export default glitchEffectButtons;
