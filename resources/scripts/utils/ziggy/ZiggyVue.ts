/* eslint-disable @typescript-eslint/no-explicit-any */
import { App } from "vue";
import { default as ziggyRoute, Config, RouteParam, RouteParamsWithQueryOverload } from "ziggy-js";
import { ZiggyRoute } from "./type";

export default {
  install: (app: App, options: Config) => {
    const route = (
      name?: any | string | undefined,
      params?: RouteParamsWithQueryOverload | RouteParam,
      absolute?: boolean,
      config: Config = options
    ) => ziggyRoute(name, params, absolute || false, config);

    app.config.globalProperties.$route = route as ZiggyRoute;

    app.provide('route', route);
  },
};
