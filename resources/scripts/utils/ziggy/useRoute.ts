import { usePage } from '@inertiajs/vue3';
import { computed, inject } from 'vue';
import { RouteParamsWithQueryOverload } from 'ziggy-js';
import { RouteName, ZiggyRoute } from './type';

export function useRoute() {
  const route = inject('route') as ZiggyRoute;

  const routeIs = computed<{
    (name: string): boolean;
    (name: RouteName): boolean;
    (name: RouteName, params: RouteParamsWithQueryOverload): boolean;
  }>(() => {
    usePage().url;

    return (name: string, params?: RouteParamsWithQueryOverload) => route().current(name, params);
  });

  return { route, routeIs };
}
