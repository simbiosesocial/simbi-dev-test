"use client";
import AppBar from "@mui/material/AppBar";
import Avatar from "@mui/material/Avatar";
import Button from "@mui/material/Button";
import Grid from "@mui/material/Grid";
import IconButton from "@mui/material/IconButton";
import MenuIcon from "@mui/icons-material/Menu";
import NotificationsIcon from "@mui/icons-material/Notifications";
import Tab from "@mui/material/Tab";
import Tabs from "@mui/material/Tabs";
import Toolbar from "@mui/material/Toolbar";
import Tooltip from "@mui/material/Tooltip";
import Typography from "@mui/material/Typography";
import { useApp } from "@/common/providers/AppProvider";
import { lightColor } from "./Header.consts";
import { usePathname } from "next/navigation";
import { useEffect, useState } from "react";
import { categories } from "../Navigator/Navigator.consts";

export function Header() {
  const { onDrawerToggle } = useApp();
  const currentPath = usePathname();
  const [title, setTitle] = useState('');

  useEffect(() => {
    let title;
    categories.forEach(({ children }) => title = children.find(child => child.url === currentPath)?.id)
    setTitle(title || 'Livros');
  }, [currentPath])
  
  return (
    <>
      <AppBar color="primary" position="sticky" elevation={0}>
        <Toolbar>
          <Grid container spacing={1} sx={{ alignItems: "center" }}>
            <Grid sx={{ display: { sm: "none", xs: "block" } }} item>
              <IconButton color="inherit" aria-label="open drawer" onClick={onDrawerToggle} edge="start">
                <MenuIcon />
              </IconButton>
            </Grid>
            <Grid item xs />
            <Grid item>
              <Tooltip title="Alerts • No alerts">
                <IconButton color="inherit">
                  <NotificationsIcon />
                </IconButton>
              </Tooltip>
            </Grid>
            <Grid item>
              <IconButton color="inherit" sx={{ p: 0.5 }}>
                <Avatar alt="Simbi" />
              </IconButton>
            </Grid>
          </Grid>
        </Toolbar>
      </AppBar>
      <AppBar component="div" color="primary" position="static" elevation={0} sx={{ zIndex: 0 }}>
        <Toolbar>
          <Grid container spacing={1} sx={{ alignItems: "center" }}>
            <Grid item xs>
              <Typography color="inherit" variant="h5" component="h1">
                {title}
              </Typography>
            </Grid>
            <Grid item>
              <Button sx={{ borderColor: lightColor }} variant="outlined" color="inherit" size="small" href="https://www.simbi.social">
                Simbi
              </Button>
            </Grid>
          </Grid>
        </Toolbar>
      </AppBar>
      <AppBar component="div" position="static" elevation={0} sx={{ zIndex: 0 }}>
        <Tabs value={0} textColor="inherit">
          <Tab label="Todos" />
        </Tabs>
      </AppBar>
    </>
  );
}
