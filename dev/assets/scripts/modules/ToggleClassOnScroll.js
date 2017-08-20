import waypoints from '../../../../node_modules/waypoints/lib/noframework.waypoints';

class ToggleClassOnScroll {
  constructor(selector, classToAdd, offset) {
    this.itemToAddClass = document.querySelector(selector);
    this.classToAdd = classToAdd;
    this.offset = offset;
    this.createWaypoints();
    this.refresher();
  }
  
  createWaypoints() {
    
    var that = this,
      currentItem = this.itemToAddClass;
    new Waypoint({
      element: currentItem,
      handler: function(direction) {
        if (direction !== "up") {
          currentItem.classList.add(that.classToAdd);
          
        } else {
          currentItem.classList.remove(that.classToAdd);
        }
      },
      offset: that.offset,
    }); 
  }  

  refresher() {
    window.addEventListener("resize", function() {
      Waypoint.refreshAll();
      console.log("refresher")
    });    
  }
}

export default ToggleClassOnScroll;