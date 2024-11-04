import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
gsap.registerPlugin(ScrollTrigger);

//zoom image
const animateImagesOnScroll = () => {
    const images = document.querySelectorAll('.animation-gsap img'); 

    const isElementInViewport = (el) => {
        const rect = el.getBoundingClientRect();
        return (
            rect.top < window.innerHeight && 
            rect.bottom > 0 
        );
    };

    const handleScroll = () => {
        images.forEach((image) => {
            if (isElementInViewport(image)) {
                gsap.to(image, { 
                    scale: 1.2,
                    duration: 0.5,
                    ease: 'power2.out'
                });
            }
        });
    };

    window.addEventListener('scroll', handleScroll);
};

animateImagesOnScroll();


//add background
gsap.to(".about-page__content-bottom", {
    scrollTrigger: {
        trigger: ".about-page__content-bottom",
        start: "top top",
        end: "top top",
        onEnter: () => {
            gsap.set(".about-page__content-bottom", { backgroundColor: "#F5F5F5", duration: 0.5 });
        },
        onLeaveBack: () => {
            gsap.set(".about-page__content-bottom", { backgroundColor: "" });
        }
    }
});


