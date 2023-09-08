"use strict";
const setImageSize = (container, img) => (img.style.width = `${container.clientWidth}px`);
document.addEventListener("DOMContentLoaded", () => {
    let scrolling = false;
    let halfWindow = (window.innerHeight || document.documentElement.clientHeight) * 0.5;
    const containers = document.querySelectorAll(".customeleaddon-image-comparison");
    if (!containers)
        return console.log("no container available");
    for (const container of containers) {
        const slider = container.querySelector(".slider");
        if (!slider)
            continue;
        // initial value
        container.style.setProperty("--position", `${slider.value}%`);
        // update upon input change
        slider.addEventListener("input", (e) => {
            const item = e.target;
            container.style.setProperty("--position", `${item.value}%`);
        });
        // set image size
        const img = container.querySelector(".after-section > img");
        if (!img)
            continue;
        setImageSize(container, img);
        window.addEventListener("resize", () => {
            halfWindow = window.innerHeight * 0.5;
            setImageSize(container, img);
        });
        //draggable
        const divider = container.querySelector(".divider");
        if (!divider)
            continue;
        for (const eventName of ["mousedown", "touchstart"]) {
            slider.addEventListener(eventName, () => divider.classList.add("draggable"));
        }
        for (const eventName of ["mouseup", "touchend", "touchcancel"]) {
            slider.addEventListener(eventName, () => divider.classList.remove("draggable"));
        }
    }
    //check if the .customeleaddon-image-comparison is in the viewport
    //if yes, animate it
    function checkPosition(containers) {
        for (const container of containers) {
            const containerPosition = container.getBoundingClientRect().top;
            if (halfWindow + window.scrollY > containerPosition)
                container.classList.add("is-visible");
        }
        scrolling = false;
    }
    checkPosition(containers); // check if already is in viewport
    // window.addEventListener("scroll", () => {
    //     if (!scrolling) {
    //         scrolling = true;
    //         requestAnimationFrame(() => checkPosition(containers));
    //     }
    // });
    let observer = new IntersectionObserver((entries) => {
        for (const entry of entries) {
            if (entry.isIntersecting) {
                observer.unobserve(entry.target);
                checkPosition(containers);
            }
        }
    }, { threshold: 0.5, });
    for (const container of containers)
        observer.observe(container);
});
