/* eslint-disable import/export */
import type { FunctionComponent, PropsWithChildren, ReactNode } from "react";

import type { RenderOptions } from "@testing-library/react";
import { render } from "@testing-library/react";
import { ThemeProvider } from "@mui/material/styles";
import { theme } from "@/common/theme";
import AppProvider from "../providers/AppProvider";

const AllProviders: FunctionComponent<PropsWithChildren> = ({ children }) => {
  return (
    <ThemeProvider theme={theme}>
      <AppProvider>{children}</AppProvider>
    </ThemeProvider>
  );
};

const customRender = (ui: ReactNode, options?: Omit<RenderOptions, "wrapper">) => render(ui, { wrapper: AllProviders, ...options });

export * from "@testing-library/react";
export { customRender as render };
