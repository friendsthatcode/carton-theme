/**
 * Really simply exposes an emitter instance we can use across all of our modules
 */
import NanoEvents from 'nanoevents';

const emitter = new NanoEvents();

export default emitter;
