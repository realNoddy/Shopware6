import Feedback from "./script/feedback";

const PluginManager = window.PluginManager;
PluginManager.override('AddToCart', Feedback, '[data-add-to-cart]');