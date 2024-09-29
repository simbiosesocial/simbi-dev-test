'use client'

import type { FunctionComponent } from "react";
import type { BookItemProps } from "./BookItem.interface";
import { Card, CardContent, CardMedia, CardActions, Button, Typography, Tooltip } from "@mui/material";

export const BookItem: FunctionComponent<BookItemProps> = ({ id, title, coverUrl }) => {
  const loanBook = async () => {
    console.log(process.env)
    try {
      const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/loans/book/${id}`, {
        method: 'POST',
      });

      if (!response.ok) {
        throw new Error("Failed to loan book", { cause: response.statusText });
      }

      await response.json();

      alert('Empréstimo feito com sucesso')
    } catch {
      alert('Erro ao pegar livro emprestado')
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
        <Button size="small" variant="contained" fullWidth onClick={loanBook}>
          Empréstimo
        </Button>
      </CardActions>
    </Card>
  );
};
