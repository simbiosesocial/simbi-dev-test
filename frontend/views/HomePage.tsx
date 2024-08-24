"use client";

import AppBar from "@mui/material/AppBar";
import Toolbar from "@mui/material/Toolbar";
import Paper from "@mui/material/Paper";
import Grid from "@mui/material/Grid";
import Button from "@mui/material/Button";
import TextField from "@mui/material/TextField";
import SearchIcon from "@mui/icons-material/Search";
import { BooksList, CreateBookDialog } from "@/features/components";
import { Box } from "@mui/material";
import { useState } from "react";

type ViewProps = {
  books: Book[];
};

export default function HomePageView({ books = [] }: ViewProps) {
  const [shouldCreateBook, setShouldCreateBook] = useState(false);
  
  const handleCreateBookDialogOpen = () => setShouldCreateBook(true);

  return (
    <Paper sx={{ maxWidth: 936, margin: "auto", overflow: "hidden" }}>
      <AppBar position="static" color="default" elevation={0} sx={{ borderBottom: "1px solid rgba(0, 0, 0, 0.12)" }}>
        <Toolbar>
          <Grid container spacing={2} sx={{ alignItems: "center" }}>
            <Grid item>
              <SearchIcon color="inherit" sx={{ display: "block" }} />
            </Grid>
            <Grid item xs>
              <TextField
                fullWidth
                placeholder="Pesquisar pelo título, autor ou ID"
                InputProps={{
                  disableUnderline: true,
                  sx: { fontSize: "default" },
                }}
                variant="standard"
              />
            </Grid>
            <Grid item>
              <Button variant="contained" sx={{ mr: 1 }} onClick={handleCreateBookDialogOpen}>
                Adicionar um livro
              </Button>
            </Grid>
          </Grid>
        </Toolbar>
      </AppBar>
      <Box sx={{ my: 5, mx: 2 }}>
        <BooksList books={books} />
      </Box>
      <CreateBookDialog shouldOpen={shouldCreateBook} openCloseControl={setShouldCreateBook} />
    </Paper>
  );
}
