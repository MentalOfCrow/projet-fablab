document.addEventListener("DOMContentLoaded", function() {
  anime({
      targets: '.row svg',
      translateY: 10,
      autoplay: true,
      loop: true,
      easing: 'easeInOutSine',
      direction: 'alternate'
  });

  anime({
      targets: '#zero',
      translateX: 10,
      autoplay: true,
      loop: true,
      easing: 'easeInOutSine',
      direction: 'alternate',
      scale: [{ value: 1 }, { value: 1.4 }, { value: 1, delay: 250 }],
      rotateY: { value: '+=180', delay: 200 }
  });

  anime({
      targets: '#handboy',
      rotate: [ { value: 10 }, { value: -10 } ],
      easing: 'easeInOutSine',
      direction: 'alternate',
      loop: true,
      duration: 1300
  });

  anime({
      targets: '#girllight',
      rotate: [ { value: 10 }, { value: -10 } ],
      easing: 'easeInOutSine',
      direction: 'alternate',
      loop: true,
      duration: 1300
  });

  anime({
      targets: '#hairgirl',
      rotate: [ { value: 6 }, { value: -6 } ],
      easing: 'easeInOutSine',
      direction: 'alternate',
      loop: true,
      duration: 1300
  });
});
