declare module "ziggy-js";

import { Config, RouteParamsWithQueryOverload, RouteParam, Router } from "ziggy-js";
import { Ziggy } from ".";

export type RouteName = keyof (typeof Ziggy)['routes'];

declare function route(
  name: RouteName,
  params?: RouteParamsWithQueryOverload | RouteParam,
  absolute?: boolean,
  config?: Config,
): string;

declare function route(
  name?: undefined,
  params?: RouteParamsWithQueryOverload | RouteParam,
  absolute?: boolean,
  config?: Config,
): Router;

export type ZiggyRoute = typeof route;

declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    $route: ZiggyRoute;
  }
}

declare global {
  interface Window {
    Ziggy?: Config;
  }
}
