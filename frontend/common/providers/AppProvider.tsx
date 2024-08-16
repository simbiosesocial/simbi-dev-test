"use client";

import type { FunctionComponent, PropsWithChildren } from "react";
import { useMemo, useState, createContext, useContext, useCallback } from "react";

type AppContextProps = {
  mobileOpen: boolean;
  onDrawerToggle: () => void;
};

const AppContext = createContext<AppContextProps>({} as AppContextProps);

const AppProvider: FunctionComponent<PropsWithChildren> = ({ children }) => {
  const [mobileOpen, setMobileOpen] = useState(false);

  const onDrawerToggle = useCallback(() => {
    setMobileOpen((prev) => !prev);
  }, []);

  const values = useMemo(
    () => ({
      mobileOpen,
      onDrawerToggle,
    }),
    [mobileOpen, onDrawerToggle]
  );

  return <AppContext.Provider value={values}>{children}</AppContext.Provider>;
};

export function useApp() {
  const context = useContext(AppContext);
  if (!context) {
    throw new Error("AppContext must be used within an AppProvider");
  }
  return context;
}

export default AppProvider;
