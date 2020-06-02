PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE Usuario( cd_usuario integer primary key, cd_email text, cd_senha text);
CREATE TABLE Amigo(cd_amigo integer primary key, cd_email text, cd_telefone text, fk_Usuario integer, FOREIGN KEY (fk_Usuario) REFERENCES Usuario(cd_usuario));
CREATE TABLE Emprestimo(cd_emprestimo integer primary key, nm_item text, dt_emprestimo date, dt_devolucao date, fk_Usuario integer, fk_Amigo integer, FOREIGN KEY (fk_Usuario) REFERENCES Usuario(cd_usuario), FOREIGN KEY (fk_Amigo) REFERENCES Amigo(cd_amigo));
COMMIT;
