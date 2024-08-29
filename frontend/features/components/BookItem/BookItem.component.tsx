'use client';

import { useState, type FunctionComponent } from "react";
import type { BookItemProps } from "./BookItem.interface";
import { Card, CardContent, CardMedia, CardActions, Button, Typography, Tooltip } from "@mui/material";
import { createLoan } from "@/requests/loans/createLoan";


export const BookItem: FunctionComponent<BookItemProps> = (book) => {
  const { id, title, coverUrl, isAvailable } = book;
  const [isLoading, setIsLoading] = useState(false);
  const [activateLoan, setActivateLoan] = useState<boolean>(false);

  const handleLoan = async () => {
    setIsLoading(true);
    try {
      const data = await createLoan(id);
      setActivateLoan(true);
    } catch (error) {
      console.error("Error creating loan:", error);
    } finally {
      setIsLoading(false);
    }
  }
  return (
    <Card variant="outlined">
      <CardMedia sx={{ height: 264 }} image={coverUrl ? coverUrl : "/cover.png"} title={title} />
      <CardContent>
        <Tooltip title={title} arrow>
          <Typography gutterBottom variant="h5" noWrap>
            {title}
          </Typography>
        </Tooltip>
        <Typography variant="body2" color="text.secondary">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam non arcu...
        </Typography>
      </CardContent>
      <CardActions>
        <Button 
          size="small" 
          variant="contained" 
          fullWidth 
          onClick={handleLoan}
          disabled={!isAvailable}
        >
          {isLoading ? "Processando..." : isAvailable ? "Empréstimo" : 'Emprestado' } 
        </Button>
      </CardActions>
    </Card>
  );
};
