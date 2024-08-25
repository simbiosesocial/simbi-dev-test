"use client";

import { useState, type FunctionComponent } from "react";
import type { BookItemProps } from "./BookItem.interface";
import { Card, CardContent, CardMedia, CardActions, Button, Typography, Tooltip } from "@mui/material";
import loanBook from "@/services/loanBook";
import dateObjToApiFormat from "@/common/utils/dateObjToApiFormat";

export const BookItem: FunctionComponent<BookItemProps> = ({ title, coverUrl, id }) => {
  const [loanProcesss, setLoanProcess] = useState<{isLoaning: boolean, message: string}>({isLoaning: false, message: "Aguarde"});

  const handleLoanBookAction = async (bookId: string) => {
    setLoanProcess({isLoaning: true, message: "Emprestando Livro"});
    const today = new Date();
    const todayFormatted = dateObjToApiFormat(today);

    const eightDaysLater = new Date();
    eightDaysLater.setDate(today.getDate() + 8);
    const eightDaysLaterFormatted = dateObjToApiFormat(eightDaysLater);

    try {
      await loanBook(bookId, todayFormatted, eightDaysLaterFormatted);
      setLoanProcess({isLoaning: true, message: "Livro Emprestado! 😀"})
    } catch (error) {
      setLoanProcess({isLoaning: true, message: "Occorreu Um Erro 😔. Talvez já tenha sido emprestado"});
    }
    setTimeout(() => setLoanProcess({isLoaning: false, message: "Aguarde"}), 1500);
  };

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
        {
          loanProcesss.isLoaning && <Typography variant="body2">{loanProcesss.message}</Typography>
        }
      </CardContent>
      <CardActions>
        <Button size="small" variant="contained" fullWidth onClick={ () => handleLoanBookAction(id) } disabled={ loanProcesss.isLoaning }>
          Empréstimo
        </Button>
      </CardActions>
    </Card>
  );
};
