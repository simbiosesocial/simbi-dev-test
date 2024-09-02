"use client";

import type { FunctionComponent } from "react";
import type { Theme } from "@mui/material/styles";

import { Box, useMediaQuery } from "@mui/material";
import { drawerWidth } from "./Sidebar.consts";
import { Navigator } from "@/common/components";
import { useApp } from "@/common/providers/AppProvider";

export const Sidebar: FunctionComponent = () => {
  const { mobileOpen, onDrawerToggle } = useApp();
  const isSmUp = useMediaQuery((theme: Theme) => theme.breakpoints.up("sm"));

  return (
    <Box data-testid="sidebar" component="nav" sx={{ width: { sm: drawerWidth }, flexShrink: { sm: 0 } }}>
      {isSmUp ? null : (
        <Navigator
          data-testid="navigator-xs"
          PaperProps={{ style: { width: drawerWidth } }}
          variant="temporary"
          open={mobileOpen}
          onClose={onDrawerToggle}
        />
      )}
      <Navigator PaperProps={{ style: { width: drawerWidth } }} sx={{ display: { sm: "block", xs: "none" } }} />
    </Box>
  );
};
